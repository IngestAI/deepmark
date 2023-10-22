import { useEffect, useState, useRef } from 'react';
import { getTasksModels, getTask, getAcceptanceCriteria, createTask, getTaskStatus, getTaskResponses } from '_api/api';
import { taskModel } from '_models/models';

export const useManageTaskForm = id => {
  const [isLoading, setIsLoading] = useState(true);
  const [tasksModels, setTasksModels] = useState([]);
  const [taskData, setTaskData] = useState(taskModel);
  const [acceptanceCriteria, setAcceptanceCriteria] = useState([]);
  const [progress, setProgress] = useState(0);
  const [progressVisible, setProgressVisible] = useState(false);
  const [resultsResponse, setResultsResponse] = useState([]);

  const intervalRef = useRef(null);

  useEffect(() => {
    return () => {
      if (intervalRef.current) clearInterval(intervalRef.current);
    };
  }, []);

  const fetchTasksModels = () => {
    getTasksModels()
      .then(models => {
        const {data} = models;
        setTasksModels(data)
      })
      .finally(() => setIsLoading(false));
  }

  const fetchTaskData = id => {
    if (!id) return;
    getTask(id).then(task => {
      const {data} = task;
      setTaskData(data);
    })
  }

  const fetchAcceptanceCriteria = () => {
    getAcceptanceCriteria().then(criteria => {
      const {data} = criteria;
      setAcceptanceCriteria(data);
    })
  }

  const fetchResults = id => {
    getTaskResponses(id).then(results => {
      const {data} = results;
      setResultsResponse(data.responses);
    })
  }

  const stopCheckingTaskProgress = id => {
    clearInterval(intervalRef.current);
    setProgressVisible(false);
    fetchResults(id);
  }

  const checkTaskProgress = id => {
    intervalRef.current = setInterval(() => {
      getTaskStatus(id).then(res => {
        const {progress} = res.data;
        setProgress(progress);
        if (progress >= 100) stopCheckingTaskProgress(id);
      })
    }, 1000);
  }

  const onFormSubmit = values => {
    if (!id) {
      createTask(values).then(res => {
        const {uuid} = res;
        setProgressVisible(true);
        checkTaskProgress(uuid);
      })
    } else {
      console.log('edit task')
    }
  }

  useEffect(() => {
    fetchTasksModels();
    fetchTaskData(id);
    fetchAcceptanceCriteria();
  }, []);

  return {
    isLoading,
    tasksModels,
    taskData,
    progressVisible,
    progress,
    acceptanceCriteria,
    resultsResponse,
    onFormSubmit,
  }
}
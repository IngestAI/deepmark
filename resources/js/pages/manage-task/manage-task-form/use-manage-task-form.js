import * as yup from 'yup';
import * as formik from 'formik';
import { useEffect, useState, useRef } from 'react';
import { getTasksModels, getTask, getAcceptanceCriteria, createTask, getTaskStatus, getTaskStatistic } from '_api/api';
import { taskModel } from '_models/models';

export const useManageTaskForm = id => {
  const [isLoading, setIsLoading] = useState(true);
  const [tasksModels, setTasksModels] = useState([]);
  const [taskData, setTaskData] = useState(taskModel);
  const [acceptanceCriteria, setAcceptanceCriteria] = useState([]);
  const [progress, setProgress] = useState(0);
  const [progressVisible, setProgressVisible] = useState(false);
  const [taskStatistic, setTaskStatistic] = useState([]);
  const [isTaskStatisticLoading, setIsTaskStatisticLoading] = useState(false);

  const intervalRef = useRef(null);

  const schema = yup.object().shape({
    prompt: yup.string().required('The prompt is missed'),
    models: yup.array().min(1, 'The models are wrong'),
    condition: yup.string().required('The condition is wrong'),
    iterations: yup.number().min(1, 'The min iteration counter should be 1'),
    term: yup.string().required('The term field is required.'),
  });

  const { Formik } = formik;

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
      setAcceptanceCriteria(criteria.data);
    })
  }

  const fetchTaskStatistic = id => {
    setIsTaskStatisticLoading(true);
    getTaskStatistic(id).then(results => {
      const {data} = results;
      setIsTaskStatisticLoading(false);
      setTaskStatistic(data.statistics);

    })
  }

  const stopCheckingTaskProgress = id => {
    clearInterval(intervalRef.current);
    setProgressVisible(false);
    fetchTaskStatistic(id);
  }

  const checkTaskProgress = id => {
    intervalRef.current = setInterval(() => {
      getTaskStatus(id).then(res => {
        const {progress} = res.data;
        setProgress(progress);
        if (progress >= 100) stopCheckingTaskProgress(id);
      }).catch(() => {
        stopCheckingTaskProgress(id);
      })
    }, 1000);
  }

  const onFormSubmit = (values, actions) => {
    if (!id) {
        createTask(values).then(res => {
          const {uuid} = res;
          if (uuid) {
            setProgressVisible(true);
            checkTaskProgress(uuid);
          }
        }).catch(error => {
          const {
            prompt,
            models,
            condition,
            iterations,
            term
          } = error.response?.data.errors;

          actions.setErrors({
            prompt,
            models,
            condition,
            iterations,
            term,
          })
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
    schema,
    Formik,
    isLoading,
    tasksModels,
    taskData,
    progressVisible,
    progress,
    acceptanceCriteria,
    taskStatistic,
    isTaskStatisticLoading,
    onFormSubmit,
  }
}
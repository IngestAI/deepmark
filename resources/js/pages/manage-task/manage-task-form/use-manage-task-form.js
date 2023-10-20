import { useEffect, useState } from 'react';
import { getTasksModels, getTask } from '_api/api';
import { taskModel } from '_models/models';

export const useManageTaskForm = id => {
  const [isLoading, setIsLoading] = useState(true);
  const [tasksModels, setTasksModels] = useState([]);
  const [taskData, setTaskData] = useState(taskModel);

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

  useEffect(() => {
    fetchTasksModels();
    fetchTaskData(id);
  }, []);

  return {
    tasksModels,
    taskData,
    isLoading,
  }
}
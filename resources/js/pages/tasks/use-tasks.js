import { useEffect, useState } from 'react';
import { getTasks, removeTask } from '_api/api';

export const useTasks = () => {
  const [tasks, setTasks] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    getTasks()
      .then(tasks => {
        const {data} = tasks;
        setTasks(data)
      })
      .finally(() => setIsLoading(false));
  }, []);


  return {
    tasks,
    removeTask,
    isLoading,
  }
}
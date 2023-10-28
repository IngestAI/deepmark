import { useEffect, useState } from 'react';
import { getTasks, removeTask } from '_api/api';

export const useTasks = () => {
  const [tasks, setTasks] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  const fetchTasks = () => {
    getTasks()
      .then(tasks => {
        const {data} = tasks;
        setTasks(data)
      })
      .finally(() => setIsLoading(false));
  }

  useEffect(() => {
    fetchTasks();
  }, []);

  const onRemoveTask = id => {
    removeTask(id).then(() => {
      fetchTasks();
    })
  }

  return {
    tasks,
    onRemoveTask,
    isLoading,
  }
}
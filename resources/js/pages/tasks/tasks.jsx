import { Link } from 'react-router-dom';
import { TasksList } from '_components/tasks-list/tasks-list';
import { useTasks } from './use-tasks';

export const Tasks = () => {
    const {
      tasks,
      onRemoveTask,
      isLoading,
    } = useTasks();

    return (
       <>
            { isLoading
              ? 'Loading'
              : (<div>
                  <Link to="/task/add" className="btn btn-secondary">
                    <span className="material-symbols-rounded align-middle me-2">add</span>Add
                  </Link>
                  <TasksList tasks={tasks} onRemoveTask={onRemoveTask} />
                </div>
              )
            }
       </>

    )
}

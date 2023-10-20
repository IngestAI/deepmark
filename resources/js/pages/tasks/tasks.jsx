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
        <div className="card">
            <div className="card-header d-flex align-items-center justify-content-between">
                <h5 className="mb-0">Tasks History</h5>
                <Link to="/task/add" className="btn btn-secondary">
                    <span className="material-symbols-rounded align-middle me-2">add</span>Add
                </Link>
            </div>
            <div className="card-body">
              { isLoading
                ? 'Loading'
                : <TasksList tasks={tasks} onRemoveTask={onRemoveTask} />
              }
            </div>
            <div className="card-footer align-items-center d-flex justify-content-between"></div>
        </div>
    )
}

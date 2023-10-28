import { Link } from 'react-router-dom';
import { Loader } from '_components/loader/loader';
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
         <div className="toolbar px-3 px-lg-6 pt-3 pb-3">
           <div className="position-relative container-fluid px-0">
             <div className="row align-items-center position-relative">
               <div className="col-sm-7 mb-3 mb-sm-0">
                 <h3 className="mb-2"><span>IngestAI</span> Deepmark 👋</h3>
                 <p className="mb-0">Your AI performance analytics.</p>
               </div>
               <div className="col-sm-5 text-md-end">
                 <Link to="/task/add" className="btn btn-primary">
                   Add task
                 </Link>
               </div>
             </div>
           </div>
         </div>
         <div className="content px-3 px-lg-6 pt-3 pb-0 d-flex flex-column-fluid position-relative">
           <div className="container-fluid px-0">
             <div className="row">
               <div className="col-xl-12 mb-3 mb-lg-5">
                 <div className="row mb-3">
                   <div className="col">
                     <div className="card mb-4 rounded-3 shadow-sm">
                       <div className="card-header py-3">
                         <h4 className="my-0 fw-normal">Tasks History</h4>
                       </div>
                       <div className="card-body">
                         { isLoading
                           ? <Loader />
                           : <TasksList tasks={tasks} onRemoveTask={onRemoveTask} />
                         }
                       </div>
                       <div className="card-footer"></div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </>
    )
}

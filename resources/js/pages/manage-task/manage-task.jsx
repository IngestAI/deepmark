import { useParams } from 'react-router-dom';
import { ManageTaskForm } from './manage-task-form/manage-task-form';

export const ManageTask = () => {
    const { id } = useParams();
    return (
        <div className="card">
            <div className="card-header">
                <div className="row">
                    <div className="col-md-12">
                        {id ? 'Edit' : 'Add'}
                    </div>
                </div>
            </div>
            <div className="card-body">
                <ManageTaskForm id={id} />
            </div>
            <div className="card-footer align-items-center d-flex justify-content-between"></div>
        </div>
    )
}

import { useParams } from 'react-router-dom';
import { ManageTaskForm } from './manage-task-form/manage-task-form';

export const ManageTask = () => {
    const { id } = useParams();
    return (
        <ManageTaskForm id={id} />
    )
}

import ListGroup from 'react-bootstrap/ListGroup';
import { Link } from 'react-router-dom';

export const TasksList = ({ tasks, onRemoveTask }) => {
    return (
        <ListGroup>
          {tasks.map(task => (
              <ListGroup.Item key={task.uuid}>
                {task.prompt}
                <Link to={`/task/edit/${task.uuid}`} className="material-symbols-outlined">edit</Link>
                <button className="material-symbols-outlined" onClick={() => onRemoveTask(task.uuid)}>delete</button>
              </ListGroup.Item>
          ))}
        </ListGroup>
    )
}

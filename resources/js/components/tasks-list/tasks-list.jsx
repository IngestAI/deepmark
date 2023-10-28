import ListGroup from 'react-bootstrap/ListGroup';

export const TasksList = ({ tasks, onRemoveTask }) => {
    return (
        <ListGroup>
          {tasks.map(task => (
              <ListGroup.Item key={task.uuid} className="task-list-item">
                <span className="task-list-item-text">{task.prompt}</span>
                {/*<Link to={`/task/edit/${task.uuid}`} className="material-symbols-outlined">edit</Link>*/}
                <button className="material-symbols-rounded delete-button" onClick={() => onRemoveTask(task.uuid)}>delete</button>
              </ListGroup.Item>
          ))}
        </ListGroup>
    )
}

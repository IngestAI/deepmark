import { Link } from 'react-router-dom';

export const Home = () => {
    return (
        <div className="card">
            <div className="card-header d-flex align-items-center justify-content-between">
                <h5 className="mb-0">List</h5>
                <Link to="/item/add" className="btn btn-secondary">
                    <span className="material-symbols-rounded align-middle me-2">add</span>Add
                </Link>
            </div>
            <div className="card-body">
                List component
            </div>
            <div className="card-footer align-items-center d-flex justify-content-between"></div>
        </div>
    )
}

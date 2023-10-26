import { useParams } from 'react-router-dom';
import { ManageTaskForm } from './manage-task-form/manage-task-form';

export const ManageTask = () => {
    const { id } = useParams();
    return (
      <>
          <div className="toolbar px-3 px-lg-6 pt-3 pb-3">
              <div className="position-relative container-fluid px-0">
                  <div className="row align-items-center position-relative">
                      <div className="col-sm-7 mb-3 mb-sm-0">
                          <h3 className="mb-2">Compare AI Models</h3>
                          <p className="mb-0">Your AI performance analytics.</p>
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
                                          <h4 className="my-0 fw-normal">New task</h4>
                                      </div>
                                      <div className="card-body">
                                          <ManageTaskForm id={id} />
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

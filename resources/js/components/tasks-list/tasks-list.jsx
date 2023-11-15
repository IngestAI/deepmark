import cn from 'classnames';
import ProgressBar from 'react-bootstrap/ProgressBar';
import Table from 'react-bootstrap/Table';

export const TasksList = ({ tasks }) => {
    const assessmentProgressColor = value => {
        if (value <= 30) {
            return 'danger'
        } else if (value <= 80) {
            return 'warning'
        } else {
            return 'success'
        }
    }

    return (
      <>
          {tasks.map((task, index) => (
            <div className={cn('card overflow-hidden', {'mb-4': index === 0})} key={task.uuid}>
                <div className="card-header d-flex align-items-center">
                    <h5 className="mb-0">{`Task #${index + 1}`}</h5>
                    <div className="flex-shrink-0 ms-auto">
                        <a href="#" download>Download All</a>
                    </div>
                </div>
                <div className="card-body">
                    { task.prompt && (
                      <p className="mb-0">
                          {task.prompt}
                      </p>
                    )}
                    <hr />
                    { task.progress < 100
                      ? <ProgressBar striped variant="success" animated now={task.progress} />
                      : <Table responsive hover className="align-middle">
                          <thead>
                              <tr>
                                  <th>AI Model</th>
                                  <th>Avg. Latency</th>
                                  <th>Error Rate</th>
                                  <th>Assessment</th>
                                  <th className="text-end">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>Anthropic Claud-2</td>
                                  <td>250 ms</td>
                                  <td>
                                      <div className="small-progressbar">
                                          <ProgressBar
                                            striped
                                            variant={10 < 20 ? 'info' : 'danger'}
                                            animated
                                            now={10}
                                            className="height-5"
                                          />
                                      </div>
                                  </td>
                                  <td>
                                      <div className="small-progressbar">
                                          <ProgressBar
                                            striped
                                            variant={assessmentProgressColor(29)}
                                            animated
                                            now={29}
                                            className="height-5"
                                          />
                                      </div>
                                  </td>
                                  <td>
                                      <div className="d-flex justify-content-end align-items-center">
                                          <a href="#!" download>
                                              <span className="material-symbols-rounded align-middle fs-5 text-body">download</span>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Anthropic Claud-2</td>
                                  <td>250 ms</td>
                                  <td>
                                      <div className="small-progressbar">
                                          <ProgressBar
                                            striped
                                            variant={50 < 20 ? 'info' : 'danger'}
                                            animated
                                            now={50}
                                            className="height-5"
                                          />
                                      </div>
                                  </td>
                                  <td>
                                      <ProgressBar
                                        striped
                                        variant={assessmentProgressColor(81)}
                                        animated
                                        now={81}
                                        className="height-5"
                                      />
                                  </td>
                                  <td>
                                      <div className="d-flex justify-content-end align-items-center">
                                          <a href="#!" download>
                                              <span className="material-symbols-rounded align-middle fs-5 text-body">download</span>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </Table>
                    }
                </div>
            </div>
          ))}
      </>
    )
}

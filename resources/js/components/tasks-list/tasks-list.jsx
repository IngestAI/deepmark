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
            <div className={cn('card overflow-hidden', {'mt-4': index !== 0})} key={task.uuid}>
                <div className="card-header d-flex align-items-center">
                    <h5 className="mb-0">{`Task #${index + 1}`}</h5>
                    <div className="flex-shrink-0 ms-auto">
                        <a href={task.downloadAll} download>Download All</a>
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
                          {task.statistics.map((statistic) => (
                              <tr key={statistic.id}>
                                  <td>{statistic.model}</td>
                                  <td>{statistic.latency} ms</td>
                                  <td>
                                      <div className="small-progressbar">
                                          <ProgressBar
                                            striped
                                            variant={statistic.errorRate < 20 ? 'info' : 'danger'}
                                            animated
                                            now={statistic.errorRate}
                                            className="height-5"
                                          />
                                      </div>
                                  </td>
                                  <td>
                                      <div className="small-progressbar">
                                          <ProgressBar
                                            striped
                                            variant={assessmentProgressColor(statistic.assessment)}
                                            animated
                                            now={statistic.assessment}
                                            className="height-5"
                                          />
                                      </div>
                                  </td>
                                  <td>
                                      <div className="d-flex justify-content-end align-items-center">
                                          <a href={statistic.downloadUrl} download>
                                              <span className="material-symbols-rounded align-middle fs-5 text-body">download</span>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                          ))}
                          </tbody>
                      </Table>
                    }
                </div>
            </div>
          ))}
      </>
    )
}

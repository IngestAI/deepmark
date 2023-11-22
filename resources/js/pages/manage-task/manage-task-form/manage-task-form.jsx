import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import ProgressBar from 'react-bootstrap/ProgressBar';
import { Loader } from '_components/loader/loader';
import { Textarea } from '_components/textarea/texarea';
import { useManageTaskForm } from './use-manage-task-form';
import { TaskStatisticList } from '_components/task-statistic-list/task-statistic-list';
import { InputNumber } from '_components/input-number/input-number';
import { Select } from '_components/select/select';

export const ManageTaskForm = ({ id }) => {
    const {
        schema,
        Formik,
        isLoading,
        tasksModels,
        taskData,
        progressVisible,
        progress,
        acceptanceCriteria,
        taskStatistic,
        isTaskStatisticLoading,
        onFormSubmit,
    } = useManageTaskForm(id);

    return (
      <>
          {isLoading
            ? <Loader />
            : (
            <div>
                <Formik
                  validationSchema={schema}
                  onSubmit={(values, actions) => onFormSubmit(values, actions)}
                  initialValues={taskData}
                >
                    {({
                      handleSubmit,
                      handleChange,
                      handleBlur,
                      values,
                      touched,
                      errors,
                      resetForm,
                    }) => (
                      <Form noValidate onSubmit={handleSubmit}>
                          <div className="row mb-2">
                              <Textarea
                                id="prompt"
                                labelText="Input"
                                placeholder="Your query or any phrase"
                                value={values.prompt}
                                isErrors={touched.prompt && !!errors.prompt}
                                errorText={touched.prompt && errors.prompt}
                                rows="6"
                                className="col-md-12"
                                onTextareaChange={handleChange}
                                onBlur={handleBlur}
                              />
                          </div>
                          <div className="row mb-3">
                              <div className="col-md-6">
                                  <h5 className="mt-2 mb-2">AI Models</h5>
                                  { tasksModels.map(model => (
                                    <div key={model.value}>
                                        <Form.Check id={model.value}>
                                            <Form.Check.Input
                                              type="checkbox"
                                              name="models"
                                              value={model.value}
                                              onChange={handleChange}
                                              checked={values.models?.includes(model.value)}
                                            />
                                            <Form.Check.Label>
                                                <img
                                                  src={model.icon}
                                                  className="img-fluid me-1 mb-1"
                                                  height="19"
                                                  width="19"
                                                  alt=""
                                                />
                                                {model.title}
                                            </Form.Check.Label>
                                        </Form.Check>
                                    </div>
                                  ))}
                                  {touched.models && !!errors.models && (
                                    <div>{errors.models}</div>
                                  )}
                              </div>
                          </div>
                          <div className="row mb-3">
                              <div className="col-md-6">
                                  <InputNumber
                                    id="iterations"
                                    name="iterations"
                                    value={values.iterations}
                                    labelText="Number of iterations"
                                    min="1"
                                    onInputChange={handleChange}
                                    onBlur={handleBlur}
                                    isErrors={touched.iterations && !!errors.iterations}
                                    errorText={errors.iterations}
                                  />
                              </div>
                              <div className="col-md-6">
                                <Select
                                  id="condition"
                                  options={acceptanceCriteria}
                                  labelText="Acceptance Criteria"
                                  value={values.condition}
                                  onSelectChange={handleChange}
                                  onBlur={handleBlur}
                                  isErrors={touched.condition && !!errors.condition}
                                  errorText={errors.condition}
                                />
                              </div>
                          </div>
                          <div className="row mb-3">
                              <div className="col-md-12">
                                  <Textarea
                                    name="term"
                                    placeholder={values.condition === 'vectorSimilarity' ? 'Vector' : 'Phrase'}
                                    value={values.term}
                                    isErrors={touched.term && !!errors.term}
                                    errorText={touched.term && errors.term}
                                    rows="6"
                                    onTextareaChange={handleChange}
                                    onBlur={handleBlur}
                                  />
                              </div>
                          </div>
                          <div className="row">
                              <div className="d-flex flex-row">
                                  <Button variant="secondary" type="submit">
                                      <span className="material-symbols-rounded align-middle me-2">electric_bolt</span> Run
                                  </Button>
                                  <div className="ms-2">
                                      <Button
                                        variant="light"
                                        onClick={resetForm}
                                      >
                                          <span className="align-middle"></span> Clear
                                      </Button>
                                  </div>
                              </div>
                          </div>
                      </Form>
                    )}
                </Formik>
                { progressVisible && (
                    <ProgressBar
                      now={progress}
                      label={`${progress}%`}
                      className="prompt-progress-bar-skin mt-3"
                      animated
                      striped
                    />
               )}
                { isTaskStatisticLoading ? <Loader /> : <TaskStatisticList statistic={taskStatistic} /> }
            </div>
          )}
      </>
    );
}

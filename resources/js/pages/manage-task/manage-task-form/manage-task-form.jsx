import * as formik from 'formik';
import * as yup from 'yup';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import ProgressBar from 'react-bootstrap/ProgressBar';
import { Textarea } from '_components/textarea/texarea';
import { useManageTaskForm } from './use-manage-task-form';
import { TaskStatisticList } from '_components/task-statistic-list/task-statistic-list';

export const ManageTaskForm = ({ id }) => {
    const { Formik } = formik;
    const {
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

    const schema = yup.object().shape({
        prompt: yup.string().required('The prompt is missed'),
        models: yup.array().min(1, 'The models are wrong'),
        condition: yup.string().required('The condition is wrong'),
        iterations: yup.number().min(1, 'The min iteration counter should be 1'),
        term: yup.string().required('The term field is required.'),
    });

    return (
      <>
          {isLoading ? 'Loading' : (
            <div>
                <Formik
                  validationSchema={schema}
                  onSubmit={(values, actions) => onFormSubmit(values, actions)}
                  initialValues={taskData}
                >
                    {({ handleSubmit, handleChange, handleBlur, values, touched, errors }) => (
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
                                  <Form.Control
                                    type="number"
                                    name="iterations"
                                    value={values.iterations}
                                    min="1"
                                    onChange={handleChange}
                                    isInvalid={touched.iterations && !!errors.iterations}
                                  />
                                  {
                                    touched.iterations && !!errors.iterations && (
                                      <Form.Control.Feedback type="invalid">
                                          {errors.iterations}
                                      </Form.Control.Feedback>
                                    )
                                  }
                              </div>
                              <div className="col-md-6">
                                { acceptanceCriteria.length > 0 && (
                                  <Form.Select
                                    value={values.condition}
                                    onChange={handleChange}
                                    name="condition"
                                    isInvalid={touched.condition && !!errors.condition}
                                  >
                                    {acceptanceCriteria.map(criteria => (
                                      <option value={criteria.value} key={criteria.value}>
                                        {criteria.title}
                                      </option>
                                    ))}
                                  </Form.Select>
                                )}
                                  {
                                    touched.condition && !!errors.condition && (
                                      <Form.Control.Feedback type="invalid">
                                          {errors.condition}
                                      </Form.Control.Feedback>
                                    )
                                  }
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
                          <Button type="submit">Submit form</Button>
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
                { isTaskStatisticLoading ? 'Loading' : <TaskStatisticList statistic={taskStatistic} /> }
            </div>
          )}
      </>
    );
}

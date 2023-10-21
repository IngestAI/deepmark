import * as formik from 'formik';
import * as yup from 'yup';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Textarea } from '_components/textarea/texarea';
import { useManageTaskForm } from './use-manage-task-form';

export const ManageTaskForm = ({ id }) => {
    const { Formik } = formik;
    const {
        tasksModels,
        taskData,
        acceptanceCriteria,
        isLoading
    } = useManageTaskForm(id);

    console.log('acceptanceCriteria', acceptanceCriteria)

    const schema = yup.object().shape({
        prompt: yup.string().required('Required')
    });

    return (
      <>
          {isLoading ? 'Loading' : (
            <Formik
              validationSchema={schema}
              onSubmit={() => {
                  console.log('fff')
              }}
              initialValues={taskData}
            >
                {({ handleSubmit, handleChange, values, touched, errors }) => (
                  <Form noValidate onSubmit={handleSubmit}>
                      <div className="row mb-2">
                          <Textarea
                            id="prompt"
                            labelText="Input"
                            placeholder="Your query or any phrase"
                            value={values.prompt}
                            errors={errors.prompt}
                            rows="6"
                            className="col-md-12"
                            onTextareaChange={handleChange}
                          />
                      </div>
                      <div className="row mb-3">
                          <div className="col-md-6">
                              <h5 className="mt-2 mb-2">AI Models</h5>
                              { tasksModels.map(model => (
                                <div key={model.value}>
                                    <Form.Check
                                      label={model.title}
                                      name="models"
                                      id={model.value}
                                      value={model.value}
                                      onChange={handleChange}
                                      checked={values.models?.includes(model.value)}
                                    />
                                </div>
                              ))}
                          </div>
                      </div>
                      <div className="row mb-3">
                          <div className="col-md-6">
                              <Form.Control
                                type="number"
                                name="iterations"
                                value={values.iterations}
                                onChange={handleChange}
                              />
                          </div>
                          <div className="col-md-6">
                            { acceptanceCriteria.length > 0 && (
                              <Form.Select value={values.condition} onChange={handleChange} name="condition">
                                {acceptanceCriteria.map(criteria => (
                                  <option value={criteria.value} key={criteria.value}>
                                    {criteria.title}
                                  </option>
                                ))}
                              </Form.Select>
                            )}
                          </div>
                      </div>
                      <div className="row mb-3">
                          <div className="col-md-12">
                              <Textarea
                                name="term"
                                placeholder={values.condition === 'vectorSimilarity' ? 'Vector' : 'Phrase'}
                                value={values.term}
                                errors={errors.term}
                                onTextareaChange={handleChange}
                              />
                          </div>
                      </div>
                      <Button type="submit">Submit form</Button>
                  </Form>
                )}
            </Formik>
          )}
      </>
    );
}

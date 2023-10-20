import * as formik from 'formik';
import * as yup from 'yup';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Textarea } from '_components/textarea/texarea';
import { useManageTaskForm } from './use-manage-task-form';

export const ManageTaskForm = ({ id }) => {
    const { Formik } = formik;
    const {tasksModels, taskData, isLoading} = useManageTaskForm(id);

    const schema = yup.object().shape({
        prompt: yup.string().required('Required')
    });

    return (
        <>
          {isLoading ? 'Loading' : (
            <Formik
                validationSchema={schema}
                onSubmit={console.log}
                initialValues={taskData}
            >
              {({ handleSubmit, handleChange, values, touched, errors }) => (
                <Form noValidate onSubmit={handleSubmit}>
                  <Textarea
                      id="prompt"
                      labelText="Input"
                      placeholder="Your query or any phrase"
                      value={values.prompt}
                      errors={errors.prompt}
                      onTextareaChange={handleChange}
                  />
                  {
                      tasksModels?.map(model => (
                        <div key={model.value}>
                          <Form.Check
                              label={model.title}
                              name='models'
                              id={model.value}
                              value={model.value}
                              onChange={handleChange}
                              checked={values.models?.includes(model.value)}
                          />
                        </div>
                    ))
                  }

                  <Button type="submit">Submit form</Button>
                </Form>
              )}
            </Formik>
          )}
        </>
    );
}

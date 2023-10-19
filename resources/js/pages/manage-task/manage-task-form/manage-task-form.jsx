import * as formik from 'formik';
import * as yup from 'yup';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { Textarea } from '_components/textarea/texarea';

export const ManageTaskForm = ({ id }) => {
    const { Formik } = formik;

    const schema = yup.object().shape({
        prompt: yup.string().required('Required')
    });

    const modelsArray = [
        {
            value: 'gpt3',
            title: 'Some title for gpt3'
        },
        {
            value: 'gpt4',
            title: 'Some title for gpt4'
        },
        {
            value: 'gpt5',
            title: 'Some title for gpt5'
        }
    ]

    return (
        <Formik
            validationSchema={schema}
            onSubmit={console.log}
            initialValues={{
                prompt: '',
                model: ['gpt4', 'gpt5'],
            }}
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
                        modelsArray.map(model => (
                            <div key={model.value}>
                                <Form.Check
                                    label={model.title}
                                    name='model'
                                    id={model.value}
                                    value={model.value}
                                    onChange={handleChange}
                                    checked={values.model.includes(model.value)}
                                />
                            </div>
                        ))
                    }

                    <Button type="submit">Submit form</Button>
                </Form>
            )}
        </Formik>
    );
}

import Form from 'react-bootstrap/Form';

export const Textarea = ({
   id,
   name,
   labelText,
   value = '',
   rows = 3,
   onTextareaChange,
   onBlur,
   placeholder = '',
   isErrors,
   errorText,
   className
}) => {
    return (
        <Form.Group controlId={id} className={className}>
            {labelText && <Form.Label>{labelText}</Form.Label>}
            <Form.Control
                as="textarea"
                name={name}
                value={value}
                rows={rows}
                placeholder={placeholder}
                onChange={onTextareaChange}
                isInvalid={isErrors}
                onBlur={onBlur}
            />
            <Form.Control.Feedback type="invalid">
                {errorText}
            </Form.Control.Feedback>
        </Form.Group>
    )
}

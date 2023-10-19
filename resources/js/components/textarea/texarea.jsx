import React from 'react';
import Form from 'react-bootstrap/Form';

export const Textarea = ({ id, name, labelText, value = '', rows = 3, onTextareaChange, placeholder, errors }) => {
    return (
        <Form.Group controlId={id}>
            {labelText && <Form.Label>{labelText}</Form.Label>}
            <Form.Control
                as="textarea"
                name={name}
                value={value}
                rows={rows}
                placeholder={placeholder}
                onChange={onTextareaChange}
                isInvalid={!!errors}
            />
            <Form.Control.Feedback type="invalid">
                {errors}
            </Form.Control.Feedback>
        </Form.Group>
    )
}

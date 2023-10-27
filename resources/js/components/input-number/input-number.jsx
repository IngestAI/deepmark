import Form from 'react-bootstrap/Form';

export const InputNumber = ({
    id,
    name,
    value = '',
    labelText,
    min,
    onInputChange,
    onBlur,
    placeholder,
    isErrors,
    errorText
  }) => {
  return (
    <Form.Group controlId={id}>
      {labelText && <Form.Label>{labelText}</Form.Label>}
      <Form.Control
        type="number"
        name={name}
        value={value}
        placeholder={placeholder}
        min={min}
        onChange={onInputChange}
        isInvalid={isErrors}
        onBlur={onBlur}
      />
      <Form.Control.Feedback type="invalid">
        {errorText}
      </Form.Control.Feedback>
    </Form.Group>
  )
}
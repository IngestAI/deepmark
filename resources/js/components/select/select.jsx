import Form from "react-bootstrap/Form";

export const Select = ({
    id,
    name,
    options,
    value = '',
    labelText,
    onSelectChange,
    onBlur,
    isErrors,
    errorText
  }) => {
  if (options.length <= 0) return null;

  return (
    <Form.Group controlId={id}>
      {labelText && <Form.Label>{labelText}</Form.Label>}
      <Form.Select
        value={value}
        onChange={onSelectChange}
        name={name}
        isInvalid={isErrors}
        onBlur={onBlur}
      >
        {options.map(item => (
          <option value={item.value} key={item.value}>
            {item.title}
          </option>
        ))}
      </Form.Select>
      <Form.Control.Feedback type="invalid">
        {errorText}
      </Form.Control.Feedback>
    </Form.Group>
  )
}
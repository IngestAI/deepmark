import Accordion from 'react-bootstrap/Accordion';

export const TaskStatisticList = ({ statistic }) => {
  if (statistic.length <= 0) return null;

  return (
    <Accordion
      className="mt-3"
      defaultActiveKey="0"
    >
      { statistic.map((statistic, index) => (
        <Accordion.Item eventKey={index} key={statistic.model}>
          <Accordion.Header>{statistic.model}</Accordion.Header>
          <Accordion.Body>
            <h6>Answers:</h6>
            { statistic.answers.length >0 && (
              statistic.answers.map((item, index) => <p key={`${index}item`}>{item}</p>)
            )}
            <h5 className="mb-0">Score: { statistic?.result?.score }</h5>
          </Accordion.Body>
        </Accordion.Item>
      ))}
    </Accordion>
  )
}
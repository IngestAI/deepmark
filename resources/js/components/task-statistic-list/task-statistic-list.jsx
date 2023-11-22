import { Accordion, AccordionItem } from '@szhsin/react-accordion';
import './task-statistic-list.scss';

export const TaskStatisticList = ({ statistic }) => {
  if (statistic.length <= 0) return null;

  return (
    <Accordion
      className="mt-3"
    >
      { statistic.map((statistic, index) => (
        <AccordionItem key={statistic.model} header={statistic.model} initialEntered>
            <h6>Answers:</h6>
            { statistic.answers.length >0 && (
              statistic.answers.map((item, index) => <p key={`${index}item`}>{item}</p>)
            )}
            <h5 className="mb-0">Score: { statistic?.assessment }</h5>
        </AccordionItem>
      ))}
    </Accordion>
  )
}

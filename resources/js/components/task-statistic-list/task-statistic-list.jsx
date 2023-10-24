import { TaskStatisticItem } from '_components/task-statistic-item/task-statistic-item';

export const TaskStatisticList = ({ statistic }) => {
  if (!statistic) return null;

  return (
    <>
      { statistic.map(statistic => <TaskStatisticItem key={statistic.model} statistic={statistic} />)}
    </>
  )
}
export const TaskResultList = ({ results }) => {
  return (
    <>
      { results.map(result => <TaskResultItem key={result.uuid} result={result} />)}
    </>
  )
}
import Spinner from 'react-bootstrap/Spinner';
import './spinner.scss';

export const Loader = () => {
  return (
    <div className="spinner">
      <Spinner animation="border" />
    </div>
  )
}
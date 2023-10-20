import axios from 'axios';

const instance = axios.create({
  headers: {'X-Bearer-Token': 'UKcqp8m816sLhzEfUo0lXOgo5uwiHtrZ'}
});

export const getTasks = () => {
  return instance.get('/api/tasks/').then(res => res.data);
}

export const removeTask = id => {
  return instance.delete(`/api/tasks/${id}`)
}
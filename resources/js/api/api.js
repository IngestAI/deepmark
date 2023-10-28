import axios from 'axios';

const instance = axios.create({
  headers: {'X-Bearer-Token': `${__BEARER_TOKEN__}`}
});

export const getTasks = () => {
  return instance.get('/api/tasks/').then(res => res.data);
}

export const removeTask = id => {
  return instance.delete(`/api/tasks/${id}`)
}

export const getTasksModels = () => {
  return instance.get('/api/models/').then(res => res.data);
}

export const getTask = id => {
  return instance.get(`/api/tasks/${id}`).then(res => res.data);
}

export const getAcceptanceCriteria = () => {
  return instance.get('/api/conditions/').then(res => res.data);
}

export const createTask = data => {
  return instance.post('/api/tasks/', data).then(res => res.data);
}

export const getTaskStatus = id => {
  return instance.get(`/api/tasks/${id}`, {
    params: {
      'scope': 'status,progress',
    }
  }).then(res => res.data);
}

export const getTaskStatistic = id => {
  return instance.get(`/api/tasks/${id}`, {
    params: {
      'scope': 'statistics',
    }
  }).then(res => res.data);
}

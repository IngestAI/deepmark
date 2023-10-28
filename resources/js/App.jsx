import { Routes, Route } from 'react-router-dom';
import { Layout } from './layout/layout';
import { Tasks } from './pages/tasks/tasks.jsx';
import { ManageTask } from './pages/manage-task/manage-task';

export const App = () => {
    return (
        <>
            <Routes>
                <Route path='/' element={<Layout />}>
                    <Route index element={<Tasks />} />
                    {/*<Route path='/task/edit/:id' element={<ManageTask />} />*/}
                    <Route path='/task/add' element={<ManageTask />} />
                </Route>
            </Routes>
        </>
    )
}

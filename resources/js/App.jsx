import { Routes, Route } from 'react-router-dom';
import { Layout } from './layout/layout';
import { Home } from './pages/home';
import { Manage } from './pages/manage/manage';

export const App = () => {
    return (
        <div>
            <Routes>
                <Route path='/' element={<Layout />}>
                    <Route index element={<Home />} />
                    <Route path='/item/edit/:id' element={<Manage />} />
                    <Route path='/item/add' element={<Manage />} />
                </Route>
            </Routes>
        </div>
    )
}

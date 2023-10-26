import { Outlet } from 'react-router-dom';
import { Header } from './header/Header';
import { Sidebar } from './sidebar/sidebar';

export const Layout = () => {
    return (
        <div className="d-flex flex-column flex-root">
            <div className="page d-flex flex-row flex-column-fluid">
                <div className="d-flex flex-column flex-row-fluid">
                    <Sidebar />
                    <main className="page-content d-flex flex-column flex-row-fluid">
                        <Header />
                        <Outlet />
                        <footer className="pb-3 pb-lg-5 px-3 px-lg-6 pt-3">
                            <div className="container-fluid px-0">
                                <span className="d-block lh-sm small text-muted text-end">
                                    &copy; {new Date().getFullYear()} IngestAI Labs, Inc. All Rights Reserved.
                                </span>
                            </div>
                        </footer>
                    </main>
                </div>
            </div>
        </div>
    )
}

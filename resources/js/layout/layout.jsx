import { Outlet } from 'react-router-dom';
import { Header } from './header/Header';

export const Layout = () => {
    return (
        <div className="d-flex flex-column flex-root">
            <div className="page d-flex flex-row flex-column-fluid">
                <div className="d-flex flex-column flex-row-fluid">
                    <Header />
                    <div className="content pt-3 px-3 px-lg-6 d-flex flex-column-fluid">
                        <div className="container-fluid px-0">
                            <div className="row">
                                <div className="col-12 mb-3 mb-lg-5">
                                    <div className="content pt-3 px-3 px-lg-6 d-flex flex-column-fluid">
                                        <div className="container-fluid px-0">
                                            <Outlet />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer className="pb-3 pb-lg-5 px-3 px-lg-6 pt-3">
                        <div className="container-fluid px-0">
                            <span className="d-block lh-sm small text-muted text-end">
                                &copy; {new Date().getFullYear()} IngestAI Labs, Inc.
                            </span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    )
}

import { Outlet, NavLink } from 'react-router-dom';
import { Header } from './header/Header';

export const Layout = () => {
    return (
        <div className="d-flex flex-column flex-root">
            <div className="page d-flex flex-row flex-column-fluid">
                <div className="d-flex flex-column flex-row-fluid">
                    <aside className="page-sidebar">
                        <div className="h-100 flex-column d-flex justify-content-start">
                            <div className="aside-logo d-flex align-items-center flex-shrink-0 justify-content-start px-5 position-relative">
                                <a href="/" className="d-block">
                                    <div className="d-flex align-items-center flex-no-wrap text-truncate">
                                        <span className="sidebar-icon size-40 d-flex">
                                            <img src="/images/logo_round.png" className="img-fluid" height="40" width="40" />
                                        </span>
                                        <span className="sidebar-text">
                                        <span className="sidebar-text text-truncate fs-3 fw-bold">IngestAI</span>
                                    </span>
                                    </div>
                                </a>
                            </div>
                            <div className="aside-menu px-3 my-auto">
                                <nav className="flex-grow-1 h-100" id="page-navbar">
                                    <ul className="nav flex-column collapse-group collapse d-flex">
                                        <li className="nav-item sidebar-title text-truncate opacity-50 small">
                                            <i className="bi bi-three-dots"></i>
                                            <span>Menu</span>
                                        </li>
                                        <li className="nav-item">
                                            <NavLink to="/" className="nav-link d-flex align-items-center text-truncate">
                                                <span className="sidebar-icon">
                                                    <span className="material-symbols-rounded">home</span>
                                                </span>
                                                <span className="sidebar-text">Dashboard</span>
                                            </NavLink>
                                        </li>
                                        <li className="nav-item">
                                            <NavLink to="/task/add" className="nav-link d-flex align-items-center text-truncate">
                                                <span className="sidebar-icon">
                                                    <span className="material-symbols-rounded">analytics</span>
                                                </span>
                                                <span className="sidebar-text">New Task</span>
                                            </NavLink>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </aside>
                    <div className="sidebar-close d-lg-none">
                        <a href="#"></a>
                    </div>
                    <main className="page-content d-flex flex-column flex-row-fluid">
                        <header className="navbar mb-3 px-3 px-lg-6 px-3 px-lg-6 align-items-center page-header navbar-expand navbar-light">
                            <a href="/" className="navbar-brand d-block d-lg-none">
                                <div className="d-flex align-items-center flex-no-wrap text-truncate">
                                    <span className="sidebar-icon size-40 d-flex">
                                        <img src="/images/logo_round.png" className="img-fluid" height="40" width="40" />
                                    </span>
                                </div>
                            </a>
                            <ul className="navbar-nav d-flex align-items-center h-100">
                                <li className="nav-item d-none d-lg-flex flex-column h-100 me-2 align-items-center justify-content-center" data-tippy-placement="bottom-start" data-tippy-content="Toggle Sidebar">
                                    <a href="/" className="sidebar-trigger nav-link size-40 d-flex align-items-center justify-content-center p-0">
                                        <span className="material-symbols-rounded">menu_open</span>
                                    </a>
                                </li>
                            </ul>
                            <ul className="navbar-nav ms-auto d-flex align-items-center h-100">
                                <li className="nav-item dropdown">
                                    <a href="#" className="nav-link dropdown-toggle d-flex align-items-center" id="bs-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                                    <span className="theme-icon-active d-flex align-items-center">
                                        <span className="material-symbols-rounded align-middle"></span>
                                    </span>
                                    </a>
                                    <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="bs-theme">
                                        <li className="mb-1"><button type="button" className="dropdown-item d-flex align-items-center active" data-bs-theme-value="light"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">lightbulb</span></span> Light</button></li>
                                        <li className="mb-1"><button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">dark_mode</span></span> Dark</button></li>
                                        <li><button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="auto"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">invert_colors</span></span> Auto</button></li>
                                    </ul>
                                </li>
                                <li className="nav-item dropdown ms-3 d-flex d-lg-none align-items-center justify-content-center flex-column h-100">
                                    <a href="/" className="nav-link sidebar-trigger-lg-down size-40 p-0 d-flex align-items-center justify-content-center">
                                        <span className="material-symbols-rounded align-middle">menu</span>
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div className="toolbar px-3 px-lg-6 pt-3 pb-3">
                            <div className="position-relative container-fluid px-0">
                                <div className="row align-items-center position-relative">
                                    <div className="col-sm-7 mb-3 mb-sm-0">
                                        <h3 className="mb-2"><span>IngestAI</span> Deepmark 👋</h3>
                                        <p className="mb-0">Your AI performance analytics.</p>
                                    </div>
                                    <div className="col-sm-5 text-md-end">
                                        <a href="/" className="btn btn-primary">Add task</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="content px-3 px-lg-6 pt-3 pb-0 d-flex flex-column-fluid position-relative">
                            <div className="container-fluid px-0">
                                <div className="row">
                                    <div className="col-xl-12 mb-3 mb-lg-5">
                                        <div className="row mb-3">
                                            <div className="col">
                                                <div className="card mb-4 rounded-3 shadow-sm">
                                                    <div className="card-header py-3">
                                                        <h4 className="my-0 fw-normal">Audio Recognition</h4>
                                                    </div>
                                                    <div className="card-body">
                                                        <Outlet />
                                                    </div>
                                                    <div className="card-footer"></div>
                                                </div>
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
                    </main>
                </div>
            </div>
        </div>
    )
}

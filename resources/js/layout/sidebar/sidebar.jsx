import { Link, NavLink } from 'react-router-dom';

export const Sidebar = () => {
  return (
    <>
      <aside className="page-sidebar">
        <div className="h-100 flex-column d-flex justify-content-start">
          <div className="aside-logo d-flex align-items-center flex-shrink-0 justify-content-start px-5 position-relative">
            <Link to="/" className="d-block">
              <div className="d-flex align-items-center flex-no-wrap text-truncate">
                <span className="sidebar-icon size-40 d-flex">
                  <img src="/images/logo_round.png" className="img-fluid" height="40" width="40" alt="" />
                </span>
                <span className="sidebar-text">
                  <span className="sidebar-text text-truncate fs-3 fw-bold">Deepmark</span>
                </span>
              </div>
            </Link>
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
      {/*<div className="sidebar-close d-lg-none">*/}
      {/*    <a href="#"></a>*/}
      {/*</div>*/}
    </>
  )
}
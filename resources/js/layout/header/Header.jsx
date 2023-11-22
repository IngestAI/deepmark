import { Link } from 'react-router-dom';

export const Header = () => {
    const toggleSidebar = () => {
        const body = document.querySelector('body');
        body.classList.toggle('page-sidebar-mini');
    }

    return (
      <header className="navbar mb-3 px-3 px-lg-6 px-3 px-lg-6 align-items-center page-header navbar-expand navbar-light">
          <Link to="/" className="navbar-brand d-block d-lg-none">
              <div className="d-flex align-items-center flex-no-wrap text-truncate">
                <span className="sidebar-icon size-40 d-flex">
                    <img src="/images/logo_round.png" className="img-fluid" height="40" width="40" alt="" />
                </span>
              </div>
          </Link>
          <ul className="navbar-nav d-flex align-items-center h-100">
              <li className="nav-item d-none d-lg-flex flex-column h-100 me-2 align-items-center justify-content-center" data-tippy-placement="bottom-start" data-tippy-content="Toggle Sidebar">
                  <button
                    onClick={() => toggleSidebar()}
                    className="sidebar-trigger nav-link size-40 d-flex align-items-center justify-content-center p-0"
                  >
                      <span className="material-symbols-rounded">menu_open</span>
                  </button>
              </li>
          </ul>
      </header>
    )
}

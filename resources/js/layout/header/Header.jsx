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
          {/*todo need implement this component later*/}
          {/*<ul className="navbar-nav ms-auto d-flex align-items-center h-100">*/}
          {/*    <li className="nav-item dropdown">*/}
          {/*        <a href="#" className="nav-link dropdown-toggle d-flex align-items-center" id="bs-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">*/}
          {/*        <span className="theme-icon-active d-flex align-items-center">*/}
          {/*            <span className="material-symbols-rounded align-middle"></span>*/}
          {/*        </span>*/}
          {/*        </a>*/}
          {/*        <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="bs-theme">*/}
          {/*            <li className="mb-1"><button type="button" className="dropdown-item d-flex align-items-center active" data-bs-theme-value="light"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">lightbulb</span></span> Light</button></li>*/}
          {/*            <li className="mb-1"><button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">dark_mode</span></span> Dark</button></li>*/}
          {/*            <li><button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="auto"><span className="theme-icon d-flex align-items-center"><span className="material-symbols-rounded align-middle me-2">invert_colors</span></span> Auto</button></li>*/}
          {/*        </ul>*/}
          {/*    </li>*/}
          {/*    <li className="nav-item dropdown ms-3 d-flex d-lg-none align-items-center justify-content-center flex-column h-100">*/}
          {/*        <button className="nav-link sidebar-trigger-lg-down size-40 p-0 d-flex align-items-center justify-content-center">*/}
          {/*            <span className="material-symbols-rounded align-middle">menu</span>*/}
          {/*        </button>*/}
          {/*    </li>*/}
          {/*</ul>*/}
      </header>
    )
}

import React from 'react';
import { Link } from 'react-router-dom';
import './header.scss';

export const Header = () => {
    return (
        <header className="navbar mb-3 ps-3 pe-1 px-lg-6 page-header navbar-expand navbar-light">
            <div className="aside-logo d-flex align-items-center flex-shrink-0 justify-content-start position-relative">
                <Link to="/" className="d-block">
                    <div className="d-flex align-items-center flex-no-wrap text-truncate">
                        <span className="sidebar-icon size-40 d-flex">
                            <img src="/images/logo_round.png" className="img-fluid" height="40" width="40" />
                        </span>
                        <span className="sidebar-text">
                            <span className="sidebar-text text-truncate fs-3 fw-bold">IngestAI</span>
                        </span>
                    </div>
                </Link>
            </div>
        </header>
    )
}

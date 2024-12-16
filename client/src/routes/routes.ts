import Dashboard from "../pages/dashboard";
import Home from "../pages/home";
import Login from "../pages/login";
import { ReactElement } from "react";

interface Route {
  path: string;
  component: () => ReactElement;
  isProtected: boolean;
}

const isProtectedRoutes: Route[] = [
  {
    path: "/",
    component: Home,
    isProtected: true,
  },
  {
    path: "/dashboard",
    component: Dashboard,
    isProtected: true,
  },
];

export const routes: Route[] = [
  {
    path: "/login",
    component: Login,
    isProtected: false,
  },
  {
    path: "/register",
    component: Login,
    isProtected: false,
  },

  ...isProtectedRoutes,
];

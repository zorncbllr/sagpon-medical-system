import Dashboard from "../pages/dashboard";
import Home from "../pages/home";
import Login from "../pages/login";
import { ReactElement } from "react";
import Register from "../pages/register";
import { Patients } from "../pages/patients";
import { Doctors } from "../pages/doctors";
import { Nurses } from "../pages/nurses";
import { Staffs } from "../pages/staffs";

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
  {
    path: "/patients",
    component: Patients,
    isProtected: true,
  },
  {
    path: "/doctors",
    component: Doctors,
    isProtected: true,
  },
  {
    path: "/nurses",
    component: Nurses,
    isProtected: true,
  },
  {
    path: "/staffs",
    component: Staffs,
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
    component: Register,
    isProtected: false,
  },

  ...isProtectedRoutes,
];

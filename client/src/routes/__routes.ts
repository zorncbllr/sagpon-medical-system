import Dashboard from "../pages/dashboard";
import Home from "../pages/home";
import Login from "../pages/login";
import { ReactElement } from "react";
import Register from "../pages/register";
import Appointments from "../pages/appointments/appointments";
import { patientRoutes } from "./patients";

export interface Route {
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
    path: "/appointments",
    component: Appointments,
    isProtected: true,
  },

  ...patientRoutes,
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

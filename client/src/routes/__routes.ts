import Dashboard from "../pages/dashboard";
import Home from "../pages/home";
import Login from "../pages/login";
import { ReactElement } from "react";
import Register from "../pages/register";
import Appointments from "../pages/appointments";
import { patientRoutes } from "./patients";
import { doctorRoutes } from "./doctors";
import { nurseRoutes } from "./nurses";
import { staffRoutes } from "./staffs";

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
  ...doctorRoutes,
  ...nurseRoutes,
  ...staffRoutes,
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

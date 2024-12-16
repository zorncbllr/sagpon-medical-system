import Dashboard from "../pages/dashboard";
import Home from "../pages/home";
import Login from "../pages/login";
import { ReactElement } from "react";
import Register from "../pages/register";
import { Patients } from "../pages/patients";
import { Doctors } from "../pages/doctors";
import { Nurses } from "../pages/nurses";
import { Staffs } from "../pages/staffs";
import { ProfileForm } from "../components/registration/profile-form";
import PatientProfile from "../pages/patient-profile";
import Appointments from "../pages/appointments";

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
  {
    path: "/patients/profiles",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/doctors/profiles",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/staffs/profiles",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/nurses/profiles",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/doctors/register",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/patients/register",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/staffs/register",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/nurses/register",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/doctors/register",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/appointments",
    component: Appointments,
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

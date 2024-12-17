import PatientProfile from "../pages/patient-profile";
import { Patients } from "../pages/patients/patients";
import { Route } from "./__routes";

export const patientRoutes: Route[] = [
  {
    path: "/patients",
    component: Patients,
    isProtected: true,
  },
  {
    path: "/patients/:patientId/profile",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/patients/register",
    component: PatientProfile,
    isProtected: true,
  },
];

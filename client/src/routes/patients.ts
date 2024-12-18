import PatientProfile from "../pages/patients/patient-profile";
import PatientRegistration from "../pages/patients/patient-registration";
import { Patients } from "../pages/patients/patients";
import { Route } from "./__routes";

export const patientRoutes: Route[] = [
  {
    path: "/patients",
    component: Patients,
    isProtected: true,
  },
  {
    path: "/patients/archives",
    component: Patients,
    isProtected: true,
  },
  {
    path: "/patients/register",
    component: PatientRegistration,
    isProtected: true,
  },
  {
    path: "/patients/:patientId",
    component: PatientProfile,
    isProtected: true,
  },
];

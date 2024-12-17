import { Doctors } from "../pages/doctors/doctors";
import PatientProfile from "../pages/patients/patient-profile";
import { Route } from "./__routes";

export const doctorRoutes: Route[] = [
  {
    path: "/doctors",
    component: Doctors,
    isProtected: true,
  },
  {
    path: "/doctors/:patientId/profile",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/doctors/register",
    component: PatientProfile,
    isProtected: true,
  },
];

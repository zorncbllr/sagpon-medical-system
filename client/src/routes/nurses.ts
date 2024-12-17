import { Nurses } from "../pages/nurses/nurses";
import PatientProfile from "../pages/patient-profile";
import { Route } from "./__routes";

export const nurseRoutes: Route[] = [
  {
    path: "/nurses",
    component: Nurses,
    isProtected: true,
  },
  {
    path: "/nurses/:patientId/profile",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/nurses/register",
    component: PatientProfile,
    isProtected: true,
  },
];

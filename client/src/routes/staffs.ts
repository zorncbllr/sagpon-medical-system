import PatientProfile from "../pages/patient-profile";
import { Staffs } from "../pages/staffs/staffs";
import { Route } from "./__routes";

export const staffRoutes: Route[] = [
  {
    path: "/staffs",
    component: Staffs,
    isProtected: true,
  },
  {
    path: "/staffs/:patientId/profile",
    component: PatientProfile,
    isProtected: true,
  },
  {
    path: "/staffs/register",
    component: PatientProfile,
    isProtected: true,
  },
];

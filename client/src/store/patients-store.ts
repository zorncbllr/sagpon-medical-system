import { create } from "zustand";
import { Patient } from "../schemas/patient-interfaces";

interface PatientStore {
  patients: Patient[];

  setPatientsData: (newData: Patient[]) => void;
  getPatientById: (patientId: string | undefined) => Patient | undefined;
}

export const usePatientStore = create<PatientStore>((set, get) => ({
  patients: [],

  setPatientsData: (newData: Patient[]) =>
    set((_) => {
      return {
        patients: newData,
      };
    }),

  getPatientById: (patientId: string | undefined) => {
    const { patients } = get();
    return patients.find((p) => p.patientId == patientId);
  },
}));

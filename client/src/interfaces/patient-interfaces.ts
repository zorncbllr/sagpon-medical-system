export interface PatientFormData {
  firstName: string;
  middleName: string;
  lastName: string;
  gender: "male" | "female" | "other";
  email: string;
  birthDate: string | number | readonly string[] | undefined;
  address: string;
  phoneNumber: number;
  photo: File | null;
  emergencyContact: number;
  insuranceProvider: string;
  policyNumber: number;
  password: string;
  confirmPassword: string;
}

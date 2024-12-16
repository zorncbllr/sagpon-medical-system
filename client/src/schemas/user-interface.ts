export interface UserLoginData {
  email: string;
  password: string;
}

export interface UserInfo {
  role: "admin" | "patient" | "doctor" | "staff" | "nurse";
}

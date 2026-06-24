import axios from 'axios';
import { avatarHTML } from './utils/avatar';

window.axios = axios;
window.avatarHTML = avatarHTML;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

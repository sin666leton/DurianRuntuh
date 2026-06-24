export function getInitials(name) {
    const parts = name.trim().split(/\s+/);
    if (parts.length === 1) {
        return parts[0].substring(0, 2).toUpperCase();
    }
    return (parts[0][0] + parts[1][0]).toUpperCase();
}

export function getAvatarColor(name) {
    const colors = [
        { bg: '#EEEDFE', border: '#534AB7', text: '#3C3489' },
        { bg: '#E1F5EE', border: '#0F6E56', text: '#085041' },
        { bg: '#FAECE7', border: '#993C1D', text: '#712B13' },
        { bg: '#FBEAF0', border: '#993556', text: '#72243E' },
        { bg: '#E6F1FB', border: '#185FA5', text: '#0C447C' },
        { bg: '#EAF3DE', border: '#3B6D11', text: '#27500A' },
        { bg: '#FAEEDA', border: '#854F0B', text: '#633806' },
        { bg: '#FCEBEB', border: '#A32D2D', text: '#791F1F' },
    ];

    let hash = 0;
    for (const char of name) {
        hash = char.charCodeAt(0) + ((hash << 5) - hash);
    }

    return colors[Math.abs(hash) % colors.length];
}

export function avatarHTML(name, size = 38) {
    const initials = getInitials(name);
    const color = getAvatarColor(name);
    const fontSize = Math.round(size * 0.33);

    return `<div style="
        width:${size}px; height:${size}px;
        border-radius:50%;
        background:${color.bg};
        color:${color.text};
        font-size:${fontSize}px;
        font-weight:500;
        display:flex; align-items:center; justify-content:center;
        user-select:none;
    ">${initials}</div>`;
}
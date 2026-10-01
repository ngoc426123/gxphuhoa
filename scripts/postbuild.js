// Bỏ hash khỏi file build: main.81ab7866.css -> main.css, main.f788d953.js -> main.js
// để theme WordPress enqueue tên cố định (cache-bust bằng filemtime trong functions.php).
const fs = require('fs');
const path = require('path');

const build = path.join(__dirname, '..', 'build');
const hashed = /^main\.[0-9a-f]+\.(.+)$/;

for (const dir of ['static/js', 'static/css']) {
  const abs = path.join(build, dir);
  if (!fs.existsSync(abs)) continue;

  for (const file of fs.readdirSync(abs)) {
    const m = file.match(hashed);
    if (!m) continue;

    const target = path.join(abs, `main.${m[1]}`);
    fs.renameSync(path.join(abs, file), target);

    // Sửa tham chiếu tới .map / .LICENSE.txt trỏ về tên file mới
    if (/\.(js|css)$/.test(target)) {
      const code = fs.readFileSync(target, 'utf8').replace(/main\.[0-9a-f]+\./g, 'main.');
      fs.writeFileSync(target, code);
    }

    console.log(`${dir}/${file} -> main.${m[1]}`);
  }
}

for (const file of ['index.html', 'asset-manifest.json']) {
  const abs = path.join(build, file);
  if (fs.existsSync(abs)) {
    fs.writeFileSync(abs, fs.readFileSync(abs, 'utf8').replace(/main\.[0-9a-f]+\./g, 'main.'));
  }
}
